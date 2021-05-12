<template>
    <span :class="{ 'badge badge-pill badge-warning align-top': basketCount !== 0 }">
        {{ basketCount === 0 ? '' : basketCount}}
    </span>
</template>

<script>
    export default {
        props: {
          basketCount: {
              required: true,
          }
        },
        mounted() {
            this.$root.$on('changeBasketCount', (newBasketCount) => {
                this.basketCount = newBasketCount
            })
        },
    }
</script>
