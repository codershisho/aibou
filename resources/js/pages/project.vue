<template>
  <page-title>案件詳細</page-title>
  <div class="tw-flex tw-gap-5">
    <div class="tw-w-2/3">
      <stepsCard :id="props.id"></stepsCard>
    </div>
    <div class="tw-w-1/3">
      <tabs :id="props.id"></tabs>
    </div>
  </div>
</template>

<script setup lang="ts">
import stepsCard from '@/components/project/stepsCard.vue';
import tabs from '@/components/project/tabs.vue';

const props = defineProps({
  id: String,
});
</script>

<style scoped></style>
