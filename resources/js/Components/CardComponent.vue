<template>
  <div class="relative font-lato card-color w-full max-w-md shadow-lg rounded-[20px] p-5">
    <div>
      <!-- Title and Value -->
      <div class="space-y-1">
        <h2 class="text-2xl font-extrabold text-primary">{{ title }}</h2>
        <p class="text-xl font-extrabold text-secondary">{{ value }}</p>
        <p class="text-sm font-semibold text-secondary whitespace-nowrap">{{ description }}</p>
      </div>

      <div :class="statusClass">
        <!-- Status -->
        <span class="absolute top-6 right-6 text-sm font-bold">
          {{ status }}
        </span>
        <svg
          v-if="isIncrease"
          xmlns="http://www.w3.org/2000/svg" 
          width="24" 
          height="24" 
          viewBox="0 0 24 24" 
          fill="none" 
          stroke="currentColor" 
          stroke-width="2" 
          stroke-linecap="round" 
          stroke-linejoin="round" 
          class="feather feather-arrow-up-right absolute w-3 h-3 top-5 right-3 bg-green-500 rounded text-white">
          <line x1="7" y1="17" x2="17" y2="7"></line>
          <polyline points="11 7 17 7 17 13"></polyline>
        </svg>
        <svg
          v-else
          xmlns="http://www.w3.org/2000/svg" 
          width="24" 
          height="24" 
          viewBox="0 0 24 24" 
          fill="none" 
          stroke="currentColor" 
          stroke-width="2" 
          stroke-linecap="round" 
          stroke-linejoin="round" 
          class="feather feather-arrow-up-right absolute w-3 h-3 top-5 right-3 rotate-90 bg-red-500 rounded text-white">
          <line x1="7" y1="17" x2="17" y2="7"></line>
          <polyline points="11 7 17 7 17 13"></polyline>
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
.card-color {
  background-color: #F8F8FB; /* Light background color */
}
.text-primary {
  color: #274C77; /* Navy blue color for title and value */
}
.text-secondary {
  color: #516F91;
}
</style>
