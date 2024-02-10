import axios from 'axios';
import { IPartner } from '@/types/partner';

const PartnerApiService = {
  index: async (): Promise<IPartner[]> => {
    return await axios.get('/partners');
  },
  show: async (id: number): Promise<IPartner> => {
    return await axios.get(`/partners/${id}`);
  },
};

export default PartnerApiService;
