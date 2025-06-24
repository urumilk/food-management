<template>
    <div>
        <table
            class="table border-collapse border border-gray-200 border-4 w-full"
        >
            <thead>
                <tr>
                    <th class="border border-gray-200 border-4 h-10">名前</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items" :key="index">
                    <td class="border border-gray-200 border-4">
                        {{ item.name }}
                    </td>
                </tr>
            </tbody>
        </table>
        <input
            class="border border-gray-200 border-4"
            v-model="newItem"
            @keydown.enter="addItem"
            placeholder="食材名を入力"
        />
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, watch } from 'vue';

const props = defineProps({
        initialItems: {
            type: Array,
            required: true
        }
    })

const items = ref([...props.initialItems])//新しい配列としてコピー
const newItem = ref('')

watch(
    () => props.initialItems,
    (newValue) => {items.value = [...newValue]}
)

const addItem = async () => {
    if (newItem.value.trim() === '') {
        return
    }
    try {
        const response = await axios.post('/favorite-ingredients', {
            name: newItem.value
        })
        items.value.push(response.data)
        newItem.value = ''
    }
    catch (error) {
        console.error('追加に失敗しました', error)
    }
}
</script>
