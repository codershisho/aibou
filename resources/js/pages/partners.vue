<template>
  <page-title>外部委託先一覧</page-title>
  <div class="tw-flex tw-flex-wrap">
    <div v-for="(partner, i) in partners" :key="i" class="tw-w-1/6 px-2 pb-6">
      <v-card class="pa-4 bg-back-lighten-2 partner-card" :to="'/partners/' + partner.id">
        <div class="text-right">
          <v-chip variant="flat" label color="primary">
            {{ partner.organization_type_name }}
          </v-chip>
        </div>
        <div class="tw-flex tw-justify-center my-2">
          <div>
            <div class="text-center">
              <v-avatar color="grey" size="60"></v-avatar>
            </div>
            <div class="tw-text-xl text-center pt-2">{{ partner.name }}</div>
          </div>
        </div>
        <div class="tw-flex tw-justify-center">
          <v-rating hover :length="5" :size="32" v-model="partner.rating" active-color="primary" />
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { default as service } from '@/services/partner';
import { IPartner } from '@/types/partner';

const partners = ref<IPartner[] | null>();

onMounted(async () => {
  partners.value = await service.index();
});
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
