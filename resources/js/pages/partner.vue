<template>
  <page-title>外部委託先詳細</page-title>
  <div class="tw-flex tw-gap-5">
    <div class="tw-w-1/2">
      <infosCard></infosCard>
    </div>
    <div class="tw-w-1/2">
      <projectsCard></projectsCard>
    </div>
  </div>
  <div class="tw-w-full pt-5">
    <docsCard></docsCard>
  </div>
</template>

<script setup lang="ts">
import infosCard from '@/components/partner/infosCard.vue';
import projectsCard from '@/components/partner/projectsCard.vue';
import docsCard from '@/components/partner/docsCard.vue';

const props = defineProps({
  id: String,
});

console.log(props.id);
</script>

<style scoped></style>
