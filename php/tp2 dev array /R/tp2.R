mu <- 200
sigma <- 30

p_moins_250 <- pnorm(250, mean = mu, sd = sigma)
cat("P(X < 250) =", round(p_moins_250, 4), "\n")

p_entre <- pnorm(220, mean = mu, sd = sigma) - pnorm(180, mean = mu, sd = sigma)
cat("P(180 < X < 220) =", round(p_entre, 4), "\n")

seuil_95 <- qnorm(0,95, mean = mu, sd = sigma)
cat("95e percentile :", round(seuil_95, 1), "ms\n")

