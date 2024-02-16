import axios from 'axios';
import { IMeeting } from '@/types/project';

const MeetingApiService = {
  index: async (id: number): Promise<IMeeting> => {
    return await axios.get(`/projects/${id}/meetings`);
  },
  store: async (id: number, params: any): Promise<IMeeting> => {
    return await axios.post(`/projects/${id}/meetings`, params);
  },
};

export default MeetingApiService;
