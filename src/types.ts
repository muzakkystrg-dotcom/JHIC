export interface NewsItem {
  id: string;
  title: string;
  category: string;
  date: string;
  image: string;
  badges: string[];
  summary: string;
  content: string;
  author: string;
  readTime: string;
}

export interface AlumniTestimonial {
  id: string;
  name: string;
  jurusan: 'SIJA' | 'TJAT';
  currentRole: string;
  institution: string;
  quote: string;
  image: string;
  linkedinUrl?: string;
  graduationYear: number;
}

export interface PartnerItem {
  name: string;
  category: string;
  color?: string;
  logoText?: string;
}

export interface JurusanDetail {
  id: 'SIJA' | 'TJAT';
  name: string;
  fullName: string;
  duration: string;
  description: string;
  suitableFor: string[];
  careerProspects: string[];
  keySubjects: string[];
  certifications: string[];
  labs: string[];
  color: string;
}

export interface QuizQuestion {
  id: number;
  question: string;
  optionA: {
    text: string;
    target: 'SIJA';
    explanation: string;
  };
  optionB: {
    text: string;
    target: 'TJAT';
    explanation: string;
  };
}
