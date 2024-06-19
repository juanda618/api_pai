<template>

    <div>
    <!-- Barra de navegación -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    
                </li>
                <li class="nav-item">
                    
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-item">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#favoritesModal">
                    Ver Favoritos
                    </button>
                </li>
            </ul>
        </div>
    </nav>



  <div class="container mt-4">
    <div class="row mb-3">
      <div class="col">
        <input v-model="search" class="form-control" placeholder="Buscar..." @input="fetchEmployees" />
      </div>
      <div class="col">
        <select v-model="sort_by" class="form-control" @change="fetchEmployees">
          <option value="satisfaction_level">Satisfacción</option>
          <option value="category">Categoría</option>
        </select>
      </div>
      <div class="col">
        <button @click="toggleSortDirection(); fetchEmployees()" class="btn btn-primary">
          Ordenar
        </button>
      </div>
    </div>

<ul class="list-group">
  <li v-for="employee in employees" :key="employee.id" class="list-group-item d-flex justify-content-between align-items-center">
    <div>
      <img :src="employee.company.logo" alt="Company Logo" class="mr-3" style="max-width: 50px;">
      <span>{{ employee.full_name }} - {{ employee.company.name }}</span>
    </div>
    <button @click="addToFavorites(employee)" class="btn btn-outline-secondary">
      Favorito
    </button>
  </li>
</ul>


  <!-- Botón para abrir el modal de favoritos -->
   

    <!-- Modal de Favoritos -->
    <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="favoritesModalLabel">Empleados Favoritos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="list-group">
              <li v-for="favorite in favorites" :key="favorite.id" class="list-group-item">
                {{ favorite.full_name }} - {{ favorite.company.name }}
              </li>
              <li v-if="favorites.length === 0" class="list-group-item text-muted">No hay empleados favoritos.</li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  <!-- Modal de Favoritos -->

    <pagination :pagination="pagination" @pagination-change-page="fetchEmployees" class="mt-4" />

    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Pagination from './Pagination.vue';

export default {
  components: {
    Pagination
  },
  data() {
    return {
      employees: [],
      pagination: {},
      search: '',
      sort_by: 'satisfaction_level',
      sort_direction: 'asc',
       favorites: [] 
    };
  },
  methods: {
    fetchEmployees(page = 1) {
      axios.get(`/api/employees?page=${page}`, {
        params: {
          search: this.search,
          sort_by: this.sort_by,
          sort_direction: this.sort_direction
        }
      }).then(response => {
        this.employees = response.data.data;
        this.pagination = response.data;
      });
    },
    addToFavorites(employee) {
        if (!this.favorites.some(fav => fav.id === employee.id)) {
            this.favorites.push(employee);
      }
    },
    toggleSortDirection() {
      this.sort_direction = this.sort_direction === 'asc' ? 'desc' : 'asc';
      this.fetchEmployees();
    }
  },
  mounted() {
    this.fetchEmployees();
  }
};
</script>
