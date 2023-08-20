<template>
  <Suspense>
    <Show />

    <template #fallback>Loading...</template>
  </Suspense>
</template>

<script setup lang="ts">
import Show from '@/components/message/MessageShow.vue'
</script>
