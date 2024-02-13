import axios from 'axios';
import { IReflection } from '@/types/project';

const ReflectionApiService = {
  show: async (id: number): Promise<IReflection> => {
    return await axios.get(`/projects/${id}/reflection`);
  },
  store: async (id: number, params: any): Promise<IReflection> => {
    return await axios.post(`/projects/${id}/reflection`, params);
  },
  update: async (id: number, reflection_id: number, params: any): Promise<IReflection> => {
    return await axios.put(`/projects/${id}/reflection/${reflection_id}`, params);
  },
};

export default ReflectionApiService;
