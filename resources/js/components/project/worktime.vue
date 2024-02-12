<template>
  <o-card title="工数">
    <div class="text-right">
      <o-savebtn @click="onSave">保存する</o-savebtn>
    </div>
    <div>
      <div class="tw-text-sm py-2">提出工数</div>
      <o-text v-model="worktime.submission_work_hours"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">提出MTG工数</div>
      <o-text v-model="worktime.submission_meeting_hours"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">見積工数</div>
      <o-text v-model="worktime.estimated_work_hours"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">実工数</div>
      <o-text v-model="worktime.actual_work_hours"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">実MTG工数</div>
      <o-text v-model="worktime.actual_meeting_hours"></o-text>
    </div>
  </o-card>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { IWorktime } from '@/types/project';
import { default as service } from '@/services/worktime';

const props = defineProps({
  id: String,
});
const worktime = ref<IWorktime>({
  id: 0,
  project_id: props.id,
  submission_work_hours: 0,
  submission_meeting_hours: 0,
  estimated_work_hours: 0,
  actual_work_hours: 0,
  actual_meeting_hours: 0,
});

onMounted(() => {
  search();
});

const search = async () => {
  const res = await service.show(props.id);
  if (res) {
    worktime.value = await service.show(props.id);
  }
};

const onSave = async () => {
  await service.store(props.id, worktime.value);
};
</script>

<style scoped></style>
