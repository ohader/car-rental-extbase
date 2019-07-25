import {Component, Input} from "@angular/core";
import {Car} from "./car";

@Component({
  selector: 'car',
  templateUrl: 'car.component.html'
})
export class CarComponent {
  @Input() public car:Car;
}
