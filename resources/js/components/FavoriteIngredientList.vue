<template>
  <div>
    <table class="table border-collapse border border-gray-200 border-4 w-full">
      <thead>
        <tr>
          <th class="border border-gray-200 border-4 h-10">名前</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in items" :key="index">
          <td class="border border-gray-200 border-4">{{ item.name }}</td>
        </tr>
        <tr>
          <input class="border border-gray-200 border-4" v-model="newItem" @keyup.enter.prevent="addItem" placeholder="食材名を入力">
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['initialItems'],

  data() {
    return {
        items: this.initialItems,
        newItem: ''
    }
  },

  methods: {
    async addItem() {
      if (this.newItem.trim() === '') return;

      try {
        const response = await axios.post('/favorite-ingredients', {
          name: this.newItem
        });

        this.items.push(response.data);  // DB保存成功 → 表示に追加
        this.newItem = '';
      } catch (error) {
        console.error('追加に失敗しました', error);
      }
    }
  }
}
</script>
