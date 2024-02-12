import axios from 'axios';
import { IWorktime } from '@/types/project';

const WorktimeApiService = {
  show: async (id: number): Promise<IWorktime> => {
    return await axios.get(`/projects/${id}/worktime`);
  },
  store: async (id: number, params: any) => {
    return await axios.post(`/projects/${id}/worktime`, params);
  },
};

export default WorktimeApiService;
