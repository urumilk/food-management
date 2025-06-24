<script setup>
    import FavoriteIngredientList from './components/FavoriteIngredientList.vue'
    const props = defineProps({
        initialItems: {
            type: Array,
            required: true
        }
    })
    console.log('test')
</script>
<template>
    <div>
        <FavoriteIngredientList :initial-items="initialItems"/>
        <h1>テスト</h1>
    </div>
</template>



