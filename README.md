[![codecov](https://codecov.io/gh/bullder/gelato/branch/master/graph/badge.svg?token=B2V2IE906G)](https://codecov.io/gh/bullder/gelato)

[![CI/CD Pipeline](https://github.com/bullder/gelato/workflows/unit/badge.svg)](https://github.com/bullder/gelato/workflows/unit/badge.svg)


I decided to try for this task slim framework because I never used it before and looks like its good opportunity to try it.

Also task is deployed on heroku [https://supergelato.herokuapp.com/?skus=A,A,B,C,D](https://supergelato.herokuapp.com/?skus=A,A,B,C,D). As soon as its on the free dyno first request might be slight slow.

If you would like to launch it local feel free to use

```shell
docker run -d -p 80:80 bullder/gelato:latest
```

# Questions

> 1. How would you implement rules like “10% off the total if you spend over $200”

I would implement an additional attribute to [Discount](https://github.com/bullder/gelato/blob/master/src/Domain/Discount.php) which will be treated not as absolute value but percentage of total  

> 2. How would you handle multiple same SKU rules?

Instead of having just a simple relation to SKU [DiscountRule](https://github.com/bullder/gelato/blob/master/src/Domain/DiscountRule.php) will have set of SKUs    

> * How would you scale this?

For now, I don't think that this task is complex enough might be if I would have some details I notice some bottlenecks, but it seems simple enough for scaling 

> * How would you deal with 1000’s of rules?

Computation of this task is low enough to not carry about having just 1000's rules

* How do you make this fault tolerant?

None of external services is involved I have no idea how simple matching and summarizing might be faulty. I have more concerns about having conflict in complex cases like if we have some discount in absolute and relative value which should be applied at first. 

> * How do you make this operation friendly?

Seems like initial business requirement was not set properly. More common way to use discount is having special promo code which is activating some special discount. That is the way how it is possible to measure marketing channels and customer engagement. With described logic we might have very tricky conflicts which might occur bigger than expected discount and validate all combinations of discount is NP-completeness problem

> * Do you need any diagrams to help you convey the solution?

Not sure about this question