import axios from 'axios';
import { IPartner, IDocument } from '@/types/partner';

const PartnerApiService = {
  index: async (): Promise<IPartner[]> => {
    return await axios.get('/partners');
  },
  show: async (id: number): Promise<IPartner> => {
    return await axios.get(`/partners/${id}`);
  },
  store: async (params: any): Promise<IPartner> => {
    return await axios.post(`/partners`, params);
  },
  update: async (id: number, params: any): Promise<IPartner> => {
    return await axios.put(`/partners/${id}`, params);
  },
  searchDocuments: async (id: number): Promise<IDocument[]> => {
    return await axios.get(`/partners/${id}/documents`);
  },
  uploadBasic: async (id: number, params: any): Promise<IDocument> => {
    return await axios.post(`/partners/${id}/documents`, params);
  },
};

export default PartnerApiService;
