import {Image} from "./image";

export class Car {
  readonly vin:string;
  readonly color:string;
  readonly brand:string;
  readonly images:Image[];

  public constructor(vin:string, color:string, brand:string, images:string[]) {
    this.vin = vin;
    this.color = color;
    this.brand = brand;
    this.images = images.map(
      (image:string) => new Image(image)
    );
  }
}
