<template>
  <page-title>外部委託先一覧</page-title>
  <div class="tw-flex tw-flex-wrap">
    <div v-for="(partner, i) in partners" :key="i" class="tw-w-1/6 px-2 pb-6">
      <v-card class="pa-4 bg-back-lighten-2 partner-card" :to="'/partners/' + partner.id">
        <div class="text-right">
          <v-chip variant="flat" label color="primary">
            {{ partner.organization_kbn_name }}
          </v-chip>
        </div>
        <div class="tw-flex tw-justify-center my-2">
          <div>
            <v-avatar color="grey" size="60"></v-avatar>
            <div class="tw-text-xl text-center">{{ partner.name }}</div>
          </div>
        </div>
        <div class="tw-flex tw-justify-center">
          <v-rating hover :length="5" :size="32" :model-value="3" active-color="primary" />
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
const partners = [
  {
    id: 1,
    name: 'aaa',
    organization_kbn: 1,
    organization_kbn_name: '個人',
    rating: 3,
  },
  {
    id: 1,
    name: 'aaa',
    organization_kbn: 1,
    organization_kbn_name: '個人',
    rating: 3,
  },
  {
    id: 1,
    name: 'aaa',
    organization_kbn: 1,
    organization_kbn_name: '個人',
    rating: 3,
  },
  {
    id: 1,
    name: 'aaa',
    organization_kbn: 1,
    organization_kbn_name: '個人',
    rating: 3,
  },
  {
    id: 1,
    name: 'aaa',
    organization_kbn: 1,
    organization_kbn_name: '個人',
    rating: 3,
  },
  {
    id: 1,
    name: 'aaa',
    organization_kbn: 1,
    organization_kbn_name: '個人',
    rating: 3,
  },
  {
    id: 1,
    name: 'aaa',
    organization_kbn: 1,
    organization_kbn_name: '個人',
    rating: 3,
  },
  {
    id: 1,
    name: 'aaa',
    organization_kbn: 1,
    organization_kbn_name: '個人',
    rating: 3,
  },
];
</script>

<style scoped>
.partner-card {
  transition: all 0.3s;
}
.partner-card:hover {
  top: -5px;
  box-shadow: 0 5px 6px rgba(189, 189, 189, 0.822);
}
</style>
