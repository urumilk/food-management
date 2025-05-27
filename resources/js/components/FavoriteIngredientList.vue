<template>
あああああ
  <div>
    <table class="table">
      <thead>
        <tr>
          <th>名前</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in items" :key="index">
          <td>{{ item.name }}</td>
        </tr>
        <tr>
          <td>
            <input v-model="newItem" @keyup.enter="addItem" placeholder="食材名を入力">
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ['initialItems'],
  data() {
    return {
      items: this.initialItems,
      newItem: ''
    }
  },
  methods: {
    addItem() {
      if (this.newItem.trim() !== '') {
        this.items.push({ name: this.newItem });
        this.newItem = '';
        // 実際はここでaxiosなどでサーバーにPOSTも必要
      }
    }
  }
}
</script>
