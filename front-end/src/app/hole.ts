export interface Hole {
  hole_id?: number;
  course_id?: number;
  hole_number: number;
  hole_par: number;
  latitude?: number;
  longitude?: number;
  avg_pop: number;
  tees: Tee[];
}

export interface Tee {
  name: string;
  distance: number;
}
