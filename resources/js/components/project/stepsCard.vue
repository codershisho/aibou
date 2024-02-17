<template>
  <o-card title="ステップチェックリスト">
    <div class="text-right mb-5">
      <o-savebtn @click="onClick">編集する</o-savebtn>
    </div>
    <MdEditor
      v-if="editMode"
      theme="dark"
      previewTheme="github"
      v-model="text"
      language="jp_JP"
      @onSave="onSave"
    />
    <MdPreview
      v-if="!editMode"
      theme="dark"
      language="jp_JP"
      previewTheme="github"
      :modelValue="text"
    />
  </o-card>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { MdEditor, MdPreview, config } from 'md-editor-v3';
import 'md-editor-v3/lib/style.css';
// import theme css
import '@vavt/cm-extension/dist/previewTheme/arknights.css';
// import existing language
import jp_JP from '@vavt/cm-extension/dist/locale/jp-JP';
import { default as service } from '@/services/project';

config({
  editorConfig: {
    languageUserDefined: {
      jp_JP: jp_JP,
    },
  },
});
const props = defineProps({
  id: String,
});

const text = ref(`Hello`);
const editMode = ref(false);

onMounted(() => {
  search();
});

const search = async () => {
  const res = await service.showStep(Number(props.id));
  if (res) {
    text.value = res;
  }
};
const onSave = async (v: string, h: Promise<string>) => {
  const res = await service.step(Number(props.id), { step: v });
  text.value = res;
  editMode.value = false;
};

const onClick = () => {
  editMode.value = true;
};
</script>

<style>
.github-theme p {
  margin-bottom: 8px !important;
}
</style>
