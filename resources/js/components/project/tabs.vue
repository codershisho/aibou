<template>
  <div class="tw-flex tw-flex-row-reverse tw-gap-5">
    <div class="tw-w-1/6 tabs-header tw-rounded-xl tw-cursor-pointer">
      <div
        v-for="(tab, i) in tabs"
        :key="i"
        class="head"
        :class="[selectedIndex === i ? 'bg-primary' : 'bg-back-lighten-2']"
        @click="changeTab(i)"
      >
        <v-icon class="pr-4"> {{ tab.icon }} </v-icon>
        {{ tab.name }}
      </div>
    </div>
    <div class="tw-w-5/6 tabs-body">
      <projectDetail v-show="tab == `projectDetail`" :id="props.id"></projectDetail>
      <worktime v-show="tab == `worktime`" :id="props.id"></worktime>
      <kpt v-show="tab == `kpt`" :id="props.id"></kpt>
      <agreement v-show="tab == `agreement`" :id="props.id"></agreement>
      <meeting v-show="tab == `meeting`" :id="props.id"></meeting>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import projectDetail from './details.vue';
import worktime from './worktime.vue';
import kpt from './kpt.vue';
import agreement from './agreement.vue';
import meeting from './meeting.vue';

const props = defineProps({
  id: String,
});

const tab = ref('projectDetail');
const tabs = ref([
  { name: '詳細', icon: 'mdi-details' },
  { name: '工数', icon: 'mdi-clock-time-eight-outline' },
  { name: 'KPT', icon: 'mdi-account-outline' },
  { name: '契約', icon: 'mdi-text-box-multiple-outline' },
  { name: '会議', icon: 'mdi-laptop-account' },
]);
const selectedIndex = ref(0);

const changeTab = (tabIndex: number) => {
  selectedIndex.value = tabIndex;
  if (tabIndex == 1) {
    tab.value = `worktime`;
    return;
  } else if (tabIndex == 2) {
    tab.value = 'kpt';
    return;
  } else if (tabIndex == 3) {
    tab.value = 'agreement';
    return;
  } else if (tabIndex == 4) {
    tab.value = 'meeting';
    return;
  }

  tab.value = 'projectDetail';
};
</script>

<style scoped>
.tabs-header > .head {
  padding: 8px 16px;
  margin-bottom: 8px;
  border-radius: 4px;
}
.tabs-body > div {
  height: 80vh !important;
  overflow-y: scroll;
}
</style>
