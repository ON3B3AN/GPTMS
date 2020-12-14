export interface Hole {
  hole_id?: number;
  course_id?: number;
  hole_number: number;
  mens_par: number;
  womens_par: number;
  mens_handicap: number;
  womens_handicap: number;
  perimeter?: any;
  avg_pop: number;
  tees: Tee[];
}

export interface Tee {
  tee_id?: number;
  tee_name: string;
  distance_to_pin: number;
}
