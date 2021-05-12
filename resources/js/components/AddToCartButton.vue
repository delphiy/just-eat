<template>
    <a href="#" @click.prevent="addToCart">Add to Cart &#10152;</a>
</template>

<script>
    export default {
        props:{
          product: {
              required: true
          }
        },
        data() {
            return {
                address: ''
            }
        },
        mounted() {
            console.log(this.product)
        },
        methods: {
            async addToCart() {
                let response = await axios.post('/basket', { product_id: this.product.id })
                this.$root.$emit('changeBasketCount', response.data.basket_count)
                console.log(response.data)
            }
        }
    }
</script>
