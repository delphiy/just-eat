<template>
    <div>
        <div class="textbox1 os-animation" data-os-animation="zoomIn" data-os-animation-delay="0.5s">
            <h3 class="address">Your Address</h3>
        </div>
        <input type="hidden" v-model="address.postal_code" name="postal_code">
        <input type="hidden" v-model="address.latitude" name="latitude">
        <input type="hidden" v-model="address.longitude" name="longitude">
        <vue-google-autocomplete
            id="map"
            ref="address"
            classname="form-control"
            placeholder="Start typing"
            v-on:placechanged="getAddressData"
            country="GB"
        >
        </vue-google-autocomplete>

    </div>
</template>

<script>
    import VueGoogleAutocomplete from 'vue-google-autocomplete'

    export default {
        data() {
            return {
                address: ''
            }
        },
        components: {
            VueGoogleAutocomplete
        },
        mounted() {
            this.$refs.address.focus();
        },
        methods: {
            getAddressData(addressData, placeResultData, id) {
                this.address = addressData
            }
        }
    }
</script>
