<template>
  <page-title>案件一覧</page-title>
  <div class="tw-flex tw-flex-row-reverse mb-5">
    <o-newbtn @click="onNew">新規作成</o-newbtn>
  </div>
  <o-card title="基本情報">
    <v-table class="bg-back-lighten-3 rounded">
      <thead>
        <tr>
          <th>ID</th>
          <th>案件コード</th>
          <th>案件名</th>
          <th>外部委託先</th>
          <th>期間</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(project, i) in projects" :key="i" @click="onClickRow(project)">
          <td>{{ project.id }}</td>
          <td>{{ project.code }}</td>
          <td>{{ project.name }}</td>
          <td>{{ project.partner_id }}</td>
          <td>{{ project.dates }}</td>
        </tr>
      </tbody>
    </v-table>
  </o-card>
  <o-dialog v-model="dialog" title="プロジェクト作成" form="project-form" @close="close" />
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { IProject } from '@/types/project';
import { default as pService } from '@/services/project';
import { useRouter } from 'vue-router';

const dialog = ref(null);
const projects = ref<IProject[] | null>(null);
const router = useRouter();

onMounted(async () => {
  search();
});

const search = async () => {
  projects.value = await pService.index();
};

const onNew = () => {
  dialog.value = true;
};

const close = () => {
  search();
};

const onClickRow = (row: IProject) => {
  router.push(`/projects/${row.id}`);
};
</script>

<style scoped></style>
