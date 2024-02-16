<template>
  <o-card title="Meetings">
    <div class="text-right mb-5">
      <o-savebtn @click="onSave">保存する</o-savebtn>
    </div>
    <div>
      <div class="tw-text-sm py-2">実施日</div>
      <VueDatePicker
        class="meeting-date"
        v-model="meeting.date"
        format="yyyy/MM/dd"
        model-type="yyyy-MM-dd"
        locale="ja"
        week-start="0"
        :enable-time-picker="false"
      />
    </div>
    <div>
      <div class="tw-text-sm py-2">会議名</div>
      <o-text v-model="meeting.name"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">時間</div>
      <o-text type="number" v-model="meeting.time"></o-text>
    </div>
    <div>
      <div class="tw-text-sm py-2">履歴（{{ totalTime }}h）</div>
      <div v-for="(meeting, i) in meetings" :key="i">
        <div>{{ meeting.name }}</div>
        <div class="d-flex align-center">
          <div class="tw-w-1/2">{{ meeting.date }}</div>
          <div class="tw-w-1/2">{{ meeting.time }}</div>
        </div>
        <v-divider class="my-2"></v-divider>
      </div>
    </div>
  </o-card>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { default as service } from '@/services/meeting';
import { IMeeting } from '@/types/project';

const props = defineProps({
  id: String,
});
const meetings = ref<IMeeting[]>();
const meeting = ref<IMeeting>({
  id: 0,
  project_id: Number(props.id),
  name: '',
  date: '',
  time: 0,
});

const totalTime = computed(() => {
  if (!Array.isArray(meetings.value)) {
    return 0;
  }
  return meetings.value.reduce(function (sum, element) {
    return sum + element.time;
  }, 0);
});

onMounted(async () => {
  search();
});

const search = async () => {
  const res = await service.index(Number(props.id));
  meetings.value = res;
};

const onSave = async () => {
  // if (meeting.value.id != 0) {
  //   // update
  //   const updRes = await service.update(Number(props.id), meeting.value.id, meeting.value);
  //   meeting.value = updRes;
  // } else {
  //   const insRes = await service.store(Number(props.id), meeting.value);
  //   meeting.value = insRes;
  // }
  const insRes = await service.store(Number(props.id), meeting.value);
  meeting.value = insRes;
  await search();
};
</script>

<style>
.meeting-date input {
  background-color: rgb(var(--v-theme-back-lighten-3)) !important;
  color: rgb(var(--v-theme-txt)) !important;
}
</style>
