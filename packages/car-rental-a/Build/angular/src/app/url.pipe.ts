import {Pipe, PipeTransform} from "@angular/core";
import {environment} from "../environments/environment";

@Pipe({
  name: 'url'
})
export class UrlPipe implements PipeTransform {
  transform(value:string):string {
    return environment.url.base + value;
  }
}
