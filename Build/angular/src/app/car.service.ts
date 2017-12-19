import {Injectable} from "@angular/core";
import {HttpClient} from "@angular/common/http";

import {Observable} from "rxjs/Observable";
import {catchError, map} from 'rxjs/operators';
import {of} from 'rxjs/observable/of';

import {Car} from "./car";
import {environment} from "../environments/environment"

@Injectable()
export class CarService {
  private http:HttpClient;
  private url:string;

  public constructor(http:HttpClient) {
    this.http = http;
    this.url = environment.url.base + environment.url.cars;
  }

  getCars():Observable<Car[]> {
    return this.http.get<Car[]>(this.url)
      .pipe(
        map((cars:any[]) => cars.map((car:any) => {
          return new Car(car.vin, car.color, car.brand, car.images);
        })),
        catchError(this.handleError([]))
      );
  }

  private handleError<T>(result?:T) {
    return (error:any): Observable<T> => {
      // @todo Add better error handling
      console.error(error); // log to console instead
      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }
}
