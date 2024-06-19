<template>
  <ul class="pagination">
    <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
      <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">Previous</a>
    </li>
    <li class="page-item" v-for="page in pages" :key="page" :class="{ active: page === pagination.current_page }">
      <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
    </li>
    <li class="page-item" :class="{ disabled: !pagination.next_page_url }">
      <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">Next</a>
    </li>
  </ul>
</template>

<script>
export default {
  props: {
    pagination: {
      type: Object,
      required: true
    }
  },
  computed: {
    pages() {
      let pagesArray = [];
      for (let page = 1; page <= this.pagination.last_page; page++) {
        pagesArray.push(page);
      }
      return pagesArray;
    }
  },
  methods: {
    changePage(page) {
      this.$emit('pagination-change-page', page);
    }
  }
}
</script>

<style>
.pagination {
  display: flex;
  list-style: none;
  padding: 0;
}
.page-item {
  margin: 0 5px;
}
.page-link {
  padding: 5px 10px;
  border: 1px solid #dee2e6;
  border-radius: 3px;
  color: #007bff;
  text-decoration: none;
}
.page-item.disabled .page-link {
  pointer-events: none;
  color: #6c757d;
}
.page-item.active .page-link {
  background-color: #007bff;
  border-color: #007bff;
  color: white;
}
</style>
