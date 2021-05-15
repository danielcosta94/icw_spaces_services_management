<template>
    <form action="/space_bookings" method="POST" v-model="space">

        <div class="col-sm-3 inline-table">
            <input class="form-control" id="date" name="date" placeholder="Date" type="text" @click="date_picker" required>
            <div class="input-group-addon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
        </div>

        <div class="col-sm-2 collapse" id="start_hour_div">
            <select id="start_hour" name="start_hour" v-model="start_hour_res" style="height: 34px;" class="form-control" @change="checkStartHourSmallerThanEndHour">
                <option :value="index" v-for="index in range(start_hour, end_hour)">{{ index + "H" }}</option>
            </select>
            <div class="input-group-addon">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
            </div>
        </div>

        <div class="col-sm-2 collapse" id="end_hour_div">
            <select id="end_hour" name="end_hour" v-model="end_hour_res" style="height: 34px;" class="form-control" @change="checkStartHourSmallerThanEndHour">
                <option selected :value="index" v-for="index in range(start_hour, end_hour + 1)">{{ index + "H" }}</option>
            </select>
            <div class="input-group-addon">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
            </div>
        </div>

        <div class="col-sm-2 inline-table" id="duration_div">
            <input class="form-control" id="duration" name="duration" placeholder="Duration" type="number" min="1" max="20" v-model="duration" required>
            <div class="input-group-addon">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
            </div>
        </div>

        <div class="col-sm-3">
            <select id="space_price_plans" name="space_price_plans" style="height: 34px;" class="form-control" v-model="space_price_plan" @click="price_plan" required>
                <option v-for="space_price_plan in space_price_plans" :value="space_price_plan.id" v-if="space_price_plan.active == 1">
                    {{ space_price_plan.price + currency.symbol }} &mdash; {{ space_price_plan.plan }}
                </option>
            </select>
        </div>

        <div class="col-sm-2 tex">
            <button class="btn-primary btn" type="submit" @click.prevent="book">Book</button>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['space_availabilties', 'user', 'currency', 'space', 'space_price_plans'],

        data: function () {
            return {
                date: '',
                space_id: this.space.id,
                space_price_plan: null,
                duration: 1,
                start_hour: null,
                end_hour: null,
                start_hour_res: null,
                end_hour_res: null,
                stripeEmail: '',
                stripeToken: '',
            }
        },

        created () {
            let module = this.$data; // cast to separate variable
            this.stripe = StripeCheckout.configure({
                key: component.stripeKey,
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "auto",

                token: function(token) {

                    this.date = module.date;
                    this.space_id = module.space_id;
                    this.space_price_plan = module.space_price_plan;
                    this.duration = module.duration;
                    this.start_hour = module.start_hour_res;
                    this.end_hour = module.end_hour_res;
                    this.stripeEmail = token.email;
                    this.stripeToken = token.id;

                    axios.post('/space_bookings', {date: this.date, space_id: this.space_id, start_hour: this.start_hour,
                        end_hour: this.end_hour, space_price_plan: this.space_price_plan, duration: this.duration,
                        stripeEmail: this.stripeEmail, stripeToken: this.stripeToken})
                        .then(
                            response => swal('Complete!', 'Thanks for your payment!',  'success')
                        )
                        .catch(
                            error => swal('Error!', error.response.data.status,  'error')
                        );
                }
            });
        },

        methods: {
            book() {
                this.date = date.value;
                this.duration = parseInt(duration.value);
                let space_price_plan_details = this.findPricePlanByID(this.space_price_plan);

                if(space_price_plan_details.plan != 'hour') {
                    this.stripe.open({
                        name: this.space.name,
                        description: this.space.description,
                        email: this.user.email,
                        zipCode:  true,
                        amount: this.duration * space_price_plan_details.price * 100,
                        currency: this.currency.code,
                    });
                } else {
                    this.stripe.open({
                        name: this.space.name,
                        description: this.space.description,
                        email: this.user.email,
                        zipCode:  true,
                        amount: (this.end_hour_res - this.start_hour_res) * space_price_plan_details.price * 100,
                        currency: this.currency.code,
                    });
                }
            },

            date_picker() {
                $("#date").datepicker({
                    minDate: 0,
                    maxDate: "+1M +10D",
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yy-mm-dd",

                });
                this.price_plan();
            },

            checkStartHourSmallerThanEndHour() {
                if(this.start_hour_res >= this.end_hour_res) {
                    this.start_hour_res = this.start_hour;
                }
            },

            price_plan() {
                let space_price_plan_details = this.findPricePlanByID(this.space_price_plan);
                let space_availability_date = this.getSpaceAvailabityByDate();

                if(space_price_plan_details.plan == 'hour' && space_availability_date != null) {
                    this.start_hour = space_availability_date.opening_hour;
                    this.end_hour = space_availability_date.closing_hour;

                    $("#start_hour_div").removeClass('collapse').addClass('inline-table');
                    $("#end_hour_div").removeClass('collapse').addClass('inline-table');
                    $("#duration_div").removeClass('inline-table').addClass('collapse');
                } else {
                    this.start_hour = null;
                    this.end_hour = null;

                    $("#start_hour_div").removeClass('inline-table').addClass('collapse');
                    $("#end_hour_div").removeClass('inline-table').addClass('collapse');
                    $("#duration_div").removeClass('collapse').addClass('inline-table');

                }
                var vm = this;
                vm.$forceUpdate();
            },

            findPricePlanByID(id) {
                return this.space_price_plans.find(space_price_plan => space_price_plan.id == id);
            },

            getSpaceAvailabityByDate() {
                let dayOfWeek = $("#date").datepicker('getDate').getUTCDay();

                switch (dayOfWeek) {

                    case 0: {
                        return this.space_availabilties.find(space_availabilty => space_availabilty.day_week == 'monday');
                    }
                    case 1: {
                        return this.space_availabilties.find(space_availabilty => space_availabilty.day_week == 'tuesday');
                    }
                    case 2: {
                        return this.space_availabilties.find(space_availabilty => space_availabilty.day_week == 'wednesday');
                    }
                    case 3: {
                        return this.space_availabilties.find(space_availabilty => space_availabilty.day_week == 'thursday');
                    }
                    case 4: {
                        return this.space_availabilties.find(space_availabilty => space_availabilty.day_week == 'friday');
                    }
                    case 5: {
                        return this.space_availabilties.find(space_availabilty => space_availabilty.day_week == 'saturday');
                    }
                    case 6: {
                        return this.space_availabilties.find(space_availabilty => space_availabilty.day_week == 'sunday');
                    }
                }
            }
        }
    }
</script>