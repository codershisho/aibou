import axios from 'axios';
import { IReflection } from '@/types/project';

const ReflectionApiService = {
  show: async (id: number): Promise<IReflection> => {
    return await axios.get(`/projects/${id}/reflection`);
  },
  store: async (id: number, params: any) => {
    return await axios.post(`/projects/${id}/reflection`, params);
  },
};

export default ReflectionApiService;
