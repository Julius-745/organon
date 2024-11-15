<template>
  <div class="card w-full max-w-md bg-base-100 shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-start">
      <!-- Title and Value -->
      <div>
        <h2 class="text-2xl font-bold text-primary">{{ title }}</h2>
        <p class="text-4xl font-semibold text-primary">{{ value }}</p>
        <p class="text-gray-500">{{ description }}</p>
      </div>

      <!-- Status -->
      <div
        :class="statusClass"
        class="flex items-center text-sm font-medium ml-4"
      >
        <span>{{ status }}</span>
        <svg
          v-if="isIncrease"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          class="w-4 h-4 ml-1"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
        <svg
          v-else
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          class="w-4 h-4 ml-1"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    value: {
      type: [String, Number],
      required: true,
    },
    description: {
      type: String,
      default: "",
    },
    status: {
      type: String,
      default: "",
    },
    isIncrease: {
      type: Boolean,
      required: true,
    },
  },
  computed: {
    statusClass() {
      return this.isIncrease ? "text-green-500" : "text-red-500";
    },
  },
};
</script>

<style scoped>
.card {
  background-color: #f8fafc; /* Light background color */
}
.text-primary {
  color: #1e3a8a; /* Navy blue color for title and value */
}
</style>
