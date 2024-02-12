export interface IPartner {
  id: number;
  name: string;
  organization_type: number;
  organization_type_name: string;
  basic_contract_flag: boolean;
  contact_person: string;
  contact: string;
  rating: number;
  specialty: string;
  memo: string;
  created_at?: string;
  updated_at?: string;
  deleted_at?: string | null;
}
