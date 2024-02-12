import axios from 'axios';
import { IProject } from '@/types/project';

const ProjectApiService = {
  index: async (): Promise<IProject[]> => {
    return await axios.get('/projects');
  },
  show: async (id: number): Promise<IProject> => {
    return await axios.get(`/projects/${id}`);
  },
  store: async (params: any) => {
    return await axios.post('/projects', params);
  },
};

export default ProjectApiService;