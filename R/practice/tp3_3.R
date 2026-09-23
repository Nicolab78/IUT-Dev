covariance <- function(x, y) {
  return(sum(x * y) / length(x) - mean(x) * mean(y))
}
x <- c(2, 2.3, 2.6, 2.9, 3.2, 3.5, 3.8, 4.1)
y <- c(52, 59, 60, 65, 70, 72, 73, 75)
covariance(x, y)
cov(x, y)