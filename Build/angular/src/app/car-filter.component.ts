import {Component, OnInit} from "@angular/core";
import {CarService} from "./car.service";
import {Car} from "./car";

@Component({
  selector: 'car-filter',
  templateUrl: './car-filter.component.html'
})
export class CarFilterComponent implements OnInit {
  private service:CarService;
  public cars:Car[] = [];
  public search:string = '';

  public constructor(service:CarService) {
    this.service = service;
  }

  public ngOnInit() {
    this.service.getCars().subscribe(
      (cars:Car[]) => this.cars = cars
    );
  }
}
