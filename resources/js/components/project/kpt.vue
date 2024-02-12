<template>
  <o-card title="KPT">
    <div class="text-right">
      <o-savebtn @click="onSave">保存する</o-savebtn>
    </div>
    <div>
      <div class="tw-text-sm py-2">Keep</div>
      <o-area v-model="reflection.keep"></o-area>
    </div>
    <div>
      <div class="tw-text-sm py-2">Problem</div>
      <o-area v-model="reflection.problem"></o-area>
    </div>
    <div>
      <div class="tw-text-sm py-2">Try</div>
      <o-area v-model="reflection.try"></o-area>
    </div>
  </o-card>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { IReflection } from '@/types/project';
import { default as service } from '@/services/reflection';

const props = defineProps({
  id: String,
});
const reflection = ref<IReflection>({
  id: 0,
  project_id: props.id,
  keep: '',
  problem: '',
  try: '',
});

onMounted(() => {
  search();
});

const search = async () => {
  const res = await service.show(props.id);
  if (res) {
    reflection.value = await service.show(props.id);
  }
};

const onSave = async () => {
  await service.store(props.id, reflection.value);
};
</script>

<style scoped></style>
