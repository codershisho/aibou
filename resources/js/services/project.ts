import axios from 'axios';
import { IProject, IAgreement } from '@/types/project';

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
  showStep: async (id: number): Promise<string | null> => {
    return await axios.get(`/projects/${id}/step`);
  },
  step: async (id: number, params: any): Promise<string> => {
    return await axios.put(`/projects/${id}/step`, params);
  },
  showAgreement: async (id: number): Promise<IAgreement> => {
    return await axios.get(`/projects/${id}/agreement`);
  },
  updateAgreement: async (id: number, params: any): Promise<IAgreement> => {
    return await axios.post(`/projects/${id}/agreement`, params);
  },
};

export default ProjectApiService;
