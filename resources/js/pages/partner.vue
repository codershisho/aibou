<template>
  <page-title>外部委託先詳細</page-title>
  <div class="tw-flex tw-gap-5">
    <div class="tw-w-1/2">
      <infosCard :id="props.id"></infosCard>
    </div>
    <div class="tw-w-1/2">
      <docsCard :id="props.id"></docsCard>
    </div>
  </div>
</template>

<script setup lang="ts">
import infosCard from '@/components/partner/infosCard.vue';
import docsCard from '@/components/partner/docsCard.vue';

const props = defineProps({
  id: String,
});
</script>

<style scoped></style>
