<template>
    <div>
        <table
            class="table border-collapse w-full"
        >
            <thead>
                <tr>
                    <th class="border border-purple-100 bg-purple-100 border-4 h-10"><input type="checkbox" id="checkAll"></th>
                    <th class="border border-purple-100 bg-purple-100 border-4 h-10">名前</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items" :key="index">
                    <td class="border border-gray-200 border-4 text-center">
                        <input type="checkbox" v-model="selectedIds" :value="item.id" />
                    </td>
                    <td class="border border-purple-100 border-4">
                        {{ item.name }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="flex gap-2 pt-4">
            <input
                class="border-4 border-orange-300 focus:border-orange-400 focus:ring-0 px-4 py-2 rounded w-64"
                v-model="newItem"
                @keydown.enter="addItem"
                placeholder="食材名を入力"
            />
            <button
                class="bg-orange-400 text-white px-4 py-2 rounded hover:bg-orange-500"
                @click="addItem"
            >
            追加
            </button>
            <button @click="bulkDelete" class="mt-4 bg-sky-300 text-white px-4 py-2 rounded">選択した食材を削除</button>
        </div>
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

console.log(props)

const items = ref([...props.initialItems])//新しい配列としてコピー
const newItem = ref('')
console.log(items.value)
console.log(newItem.value)

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

const selectedIds = ref([])
console.log(selectedIds.value)

const bulkDelete = async () => {
    if (selectedIds.value.length === 0){
        alert('削除する食材を選択してください')
        return
    }
    if (!confirm('本当に削除しますか？')){
        return
    }
    try{
        await axios.delete('/favorite-ingredients/bulk-delete', {
            data: { ids: selectedIds.value },
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
            // 成功後：削除したIDをリストから除外
            items.value = items.value.filter(item => !selectedIds.value.includes(item.id))
            selectedIds.value = []
            alert('削除しました')
    }
    catch(error){
        alert('削除に失敗しました')
        console.log(error.response)
    }
}


</script>
