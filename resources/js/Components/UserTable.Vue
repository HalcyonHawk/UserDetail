<template>
  <div>
    <table class="min-w-full divide-y divide-gray-200">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.fullName }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.type }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      users: []
    }
  },
  async created() {
    const response = await axios.get('/user')
    this.users = response.data
  }
}
</script>
