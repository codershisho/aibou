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
  project_id: Number(props.id),
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
  const res = await service.show(Number(props.id));
  if (res) {
    worktime.value = res;
  }
};

const onSave = async () => {
  if (worktime.value.id != 0) {
    // update
    const updRes = await service.update(Number(props.id), worktime.value.id, worktime.value);
    worktime.value = updRes;
    return;
  }
  const insRes = await service.store(Number(props.id), worktime.value);
  worktime.value = insRes;
};
</script>

<style scoped></style>
