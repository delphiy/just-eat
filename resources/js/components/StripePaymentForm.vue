<template>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div v-for="paymentMethod in paymentMethods">
                <div class="row" @click.prevent="selectPaymentMethod(paymentMethod.id)"
                     :class="{ 'bg-success text-light': paymentMethod.id == paymentMethodID }">
                    <div class="col-2">
                        <img src="/images/visa.png" alt="" width="100%">
                    </div>
                    <div class="col-10 mt-3">
                        {{  paymentMethod.brand.charAt(0).toUpperCase() }} {{ paymentMethod.brand.slice(1) }}
                        Ending In: {{ paymentMethod.last_four }} Exp: {{ paymentMethod.exp_month }} {{ paymentMethod.exp_year }}
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" v-model="paymentMethodID" name="paymentMethodID" id="paymentMethodID">
        <div class="col-md-9">
            <div ref="card" class="form-control" style="height: 2.4rem; padding-top: .7em"></div>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success" @click.prevent="submitPaymentMethod">Save</button>
        </div>
    </div>
</template>

<script>
let stripe = Stripe(process.env.MIX_STRIPE_KEY);
let elements = stripe.elements()
let style = {
    base: {
        border: '1px solid #D8D8D8',
        borderRadius: '4px',
        color: "#000",
    },
    invalid: {

    }
};


export default {
    data() {
        return {
            fullName: 'dsadasds',
            card: '',
            paymentMethodID: '',
            paymentMethods: [],
        }
    },
    mounted() {
        this.loadIntent()
        this.card = elements.create('card', style)
        this.card.mount(this.$refs.card)

        this.loadPaymentMethods()
    },
    methods: {
        async loadIntent() {
            let response = await axios.get('/user/setup-intent')
            this.intentToken = response.data
        },
        submitPaymentMethod() {
            stripe.confirmCardSetup(
                this.intentToken.client_secret, {
                    payment_method: {
                        card: this.card,
                        billing_details: {
                            name: this.fullName
                        }
                    }
                }
            ).then(function(result) {
                if(result.error) {
                    console.log(result.error)
                } else {
                    this.paymentMethodID = result.setupIntent.payment_method
                    this.card.clear()
                }

            }.bind(this));
        },

        async loadPaymentMethods() {
            let response = await axios.get('/user/payment-methods');
            this.paymentMethods = response.data.methods
            console.log(this.paymentMethods)
        },

        selectPaymentMethod(selectPaymentMethod) {
            this.paymentMethodID = selectPaymentMethod
        }
    },
}
</script>
