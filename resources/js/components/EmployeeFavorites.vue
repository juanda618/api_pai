<template>
  <div class="container mt-4">
    <h2 class="mb-3">Favoritos</h2>
    <ul class="list-group">
      <li v-for="employee in favorites" :key="employee.id" class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          {{ employee.full_name }} - {{ employee.company }}
        </div>
        <button @click="removeFromFavorites(employee)" class="btn btn-danger">
          Remover
        </button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      favorites: []
    };
  },
  methods: {
    removeFromFavorites(employee) {
      // Aquí implementamos la lógica para remover de favoritos
      const index = this.favorites.findIndex(emp => emp.id === employee.id);
      if (index !== -1) {
        this.favorites.splice(index, 1);
      }
    }
  }
};
</script>
