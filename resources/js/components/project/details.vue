<template>
  <o-card title="案件詳細">
    <div>
      <div class="tw-text-sm py-2">案件コード</div>
      <o-text v-model="project.code"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">案件名</div>
      <o-text v-model="project.name"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">外部委託先</div>
      <o-auto
        :items="partners"
        item-title="name"
        item-value="id"
        v-model="project.partner_id"
      ></o-auto>
    </div>
    <div>
      <div class="tw-text-sm py-2">期間</div>
      <o-text v-model="project.dates"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">ステータス</div>
      <o-auto :items="statuses" item-title="name" item-value="id" v-model="project.status"></o-auto>
    </div>
  </o-card>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { IProject } from '@/types/project';
import { default as pService } from '@/services/project';
import { default as service } from '@/services/partner';
import { IPartner } from '@/types/partner';

const partners = ref<IPartner[] | null>();

const props = defineProps({
  id: String,
});

const project = ref<IProject>({
  id: 0,
  code: '',
  name: '',
  partner_id: 0,
  dates: '',
  status: 0,
});

const statuses = ref([
  { id: 1, name: '新規' },
  { id: 2, name: '進行中' },
  { id: 3, name: '保留中' },
  { id: 4, name: '終了' },
]);

onMounted(async () => {
  project.value = await pService.show(props.id);
  partners.value = await service.index();
});
</script>

<style scoped></style>
