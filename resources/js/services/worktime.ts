import axios from 'axios';
import { IWorktime } from '@/types/project';

const WorktimeApiService = {
  show: async (id: number): Promise<IWorktime> => {
    return await axios.get(`/projects/${id}/worktime`);
  },
  store: async (id: number, params: any): Promise<IWorktime> => {
    return await axios.post(`/projects/${id}/worktime`, params);
  },
  update: async (id: number, worktime_id: number, params: any): Promise<IWorktime> => {
    return await axios.put(`/projects/${id}/worktime/${worktime_id}`, params);
  },
};

export default WorktimeApiService;
