<template>
  <div class="tw-flex tw-flex-row-reverse tw-gap-5">
    <div class="tw-w-1/6 tabs-header tw-rounded-xl">
      <div
        v-for="(tab, i) in tabs"
        :key="i"
        class="head"
        :class="[selectedIndex === i ? 'bg-primary' : 'bg-back-lighten-2']"
        @click="changeTab(i)"
      >
        <v-icon> {{ tab.icon }} </v-icon>
        {{ tab.name }}
      </div>
    </div>
    <div class="tw-w-5/6">
      <!-- <component :is="tab" :id="props.id" /> -->
      <projectDetail v-show="tab == `projectDetail`" :id="props.id"></projectDetail>
      <worktime v-show="tab == `worktime`" :id="props.id"></worktime>
      <kpt v-show="tab == `kpt`" :id="props.id"></kpt>
    </div>
    <!-- <v-tabs v-model="tab" color="primary">
      <v-tab value="1">
        <v-icon start> mdi-account-outline </v-icon>
        案件詳細
      </v-tab>
      <v-tab value="2">
        <v-icon start> mdi-file-document-multiple-outline </v-icon>
        工数
      </v-tab>
      <v-tab value="3">
        <v-icon start> mdi-file-document-multiple-outline </v-icon>
        KPT
      </v-tab>
    </v-tabs>
    <v-window class="" v-model="tab">
      <v-window-item value="1">
        <projectDetail :id="props.id"></projectDetail>
      </v-window-item>
      <v-window-item value="2">
        <worktime :id="props.id"></worktime>
      </v-window-item>
      <v-window-item value="3">
        <kpt :id="props.id"></kpt>
      </v-window-item>
    </v-window> -->
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import projectDetail from './details.vue';
import worktime from './worktime.vue';
import kpt from './kpt.vue';

// const components = { projectDetail: projectDetail, worktime: worktime, kpt: kpt };

const props = defineProps({
  id: String,
});

const tab = ref('projectDetail');
const tabs = ref([
  { name: '案件詳細', icon: 'mdi-account-outline' },
  { name: '工数', icon: 'mdi-account-outline' },
  { name: 'KPT', icon: 'mdi-account-outline' },
]);
const selectedIndex = ref(0);
const selectedColor = ref('red');
const defaultColor = ref('#ffffff');

const changeTab = (tabIndex: number) => {
  selectedIndex.value = tabIndex;
  if (tabIndex == 1) {
    tab.value = `worktime`;
    return;
  } else if (tabIndex == 2) {
    tab.value = 'kpt';
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
</style>
