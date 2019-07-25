import {Pipe, PipeTransform} from "@angular/core";
import {Car} from "./car";

@Pipe({
  name: 'carFilter'
})
export class CarFilterPipe implements PipeTransform {
  transform(value:Car[], search:string):Car[] {
    return value.filter(
      (car:Car) => CarFilterPipe.matches(car, search)
    );
  }

  private static matches(car:Car, search:string):boolean {
    if (typeof search === 'undefined' || search === '') {
      return true;
    }

    let pattern = new RegExp(search, 'i');

    return [
      car.brand.match(pattern),
      car.vin.match(pattern),
      car.color.match(pattern),
    ].some(
      (result:any[] | null) => result !== null && result.length > 0
    );
  }
}
