<template>
  <page-title>案件一覧</page-title>
  <div class="tw-flex tw-items-center mb-5">
    <div class="tw-w-1/4 tw-flex">
      <o-text
        class="tw-w-1/2 mr-2"
        placeholder="外部委託先"
        clearable
        v-model="filterPartner"
      ></o-text>
    </div>
    <div class="tw-w-3/4 text-right">
      <o-newbtn class="text-right" @click="onNew">新規作成</o-newbtn>
    </div>
  </div>
  <o-card title="基本情報">
    <v-table class="bg-back-lighten-3 rounded tw-cursor-pointer">
      <thead>
        <tr>
          <th>ID</th>
          <th>案件コード</th>
          <th>案件名</th>
          <th>外部委託先</th>
          <th>ステータス</th>
          <th>期間</th>
          <th>単価</th>
          <th>契約金額</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(project, i) in filteredProjects" :key="i" @click="onClickRow(project)">
          <td>{{ project.id }}</td>
          <td>{{ project.code }}</td>
          <td>{{ project.name }}</td>
          <td>{{ project.partner.name }}</td>
          <td>
            <v-chip class="w-50" :color="chipColor(project.status)" label variant="flat">
              <div class="text-center">
                {{ project.status_name }}
              </div>
            </v-chip>
          </td>
          <td>{{ project.dates }}</td>
          <td>{{ project.price }}</td>
          <td>{{ project.money }}</td>
        </tr>
      </tbody>
    </v-table>
  </o-card>
  <o-dialog v-model="dialog" title="プロジェクト作成" form="project-form" @close="close" />
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { IProject } from '@/types/project';
import { default as pService } from '@/services/project';
import { useRouter } from 'vue-router';

const dialog = ref(null);
const projects = ref<IProject[]>([]);
const router = useRouter();
const filterPartner = ref('');

onMounted(async () => {
  search();
});

const search = async () => {
  projects.value = await pService.index();
};

const chipColor = (status_id: number) => {
  switch (status_id) {
    case 2:
      return 'green';
    case 3:
      return 'brown';
    case 4:
      return 'blue-grey';
    default:
      return 'primary';
  }
};
const filteredProjects = computed(() => {
  if (projects.value.length === 0) {
    return [];
  }
  if (!filterPartner.value) {
    return projects.value;
  }

  return projects.value.filter((item) => item.partner.name.includes(filterPartner.value));
});

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
