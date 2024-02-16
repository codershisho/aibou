export interface IProject {
  id: number;
  code: string;
  name: string;
  partner_id: number;
  dates: string;
  status: number;
  step: string;
}

export interface IWorktime {
  id: number;
  project_id: number;
  submission_work_hours: number;
  submission_meeting_hours: number;
  estimated_work_hours: number;
  actual_work_hours: number;
  actual_meeting_hours: number;
}

export interface IReflection {
  id: number;
  project_id: number;
  keep: string;
  problem: string;
  try: string;
}

export interface IAgreement {
  id: number;
  agreement_path: string | null;
  price: number | null;
}

export interface IMeeting {
  id: number;
  project_id: number;
  name: string;
  date: string;
  time: number;
}
