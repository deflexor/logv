<template>
  <div>
    <input v-model="filter" placeholder="Filter by IP" />
    <b-table striped hover :items="filteredLogs" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc">
      <template v-slot:cell(ip)="row">
        {{ row.item.ip }}
      </template>
      <template v-slot:cell(user)="row">
        {{ row.item.user }}
      </template>
      <template v-slot:cell(request)="row">
        {{ row.item.request }}
      </template>
      <!-- Add additional columns for other log fields -->
    </b-table>
  </div>
</template>

<script lang="ts">

export default {
  data() {
    return {
      logs: [],       // Array to hold the log data
      filter: '',     // Input field for filtering by IP
      sortBy: '',     // Sort column
      sortDesc: false // Sort direction
    };
  },
  computed: {
    filteredLogs() {
      // Apply filtering based on IP
      const filtered = this.logs.filter((log) =>
        log.ip.toLowerCase().includes(this.filter.toLowerCase())
      );

      // Apply sorting
      const sorted = filtered.sort((a, b) => {
        const sortKey = this.sortBy.toLowerCase();
        if (a[sortKey] < b[sortKey]) return this.sortDesc ? 1 : -1;
        if (a[sortKey] > b[sortKey]) return this.sortDesc ? -1 : 1;
        return 0;
      });

      return sorted;
    },
    fields() {
      // Define the table columns
      return [
        { key: 'ip', sortable: true },
        { key: 'user', sortable: true },
        { key: 'request', sortable: true },
        // Add additional columns for other log fields
      ];
    },
  },
  mounted() {
    // Fetch log data from your API or data source
    // and assign it to the logs array
    // Example:
    this.logs = [
      { id: 1, ip: '127.0.0.1', user: 'admin', request: '/path1' },
      { id: 2, ip: '192.168.0.1', user: 'guest', request: '/path2' },
      // Add more log objects
    ];
  },
};
</script>
